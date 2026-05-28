import { useMemo, useState } from 'react';
import MatchCardsSection from '../Components/MatchCardsSection';
import {
    formatWeekRangeLabel,
    toWeekStartKey,
} from '../../Site/utils/date';

export default function MatchesPageContent({ upcomingMatches, recentMatches }) {
    const currentWeekKey = toWeekStartKey(new Date());

    const weekKeys = useMemo(() => {
        const allMatches = [...upcomingMatches, ...recentMatches];
        const uniqueKeys = Array.from(
            new Set(
                allMatches
                    .map((match) => toWeekStartKey(match.match_date))
                    .filter(Boolean),
            ),
        ).sort();

        if (!uniqueKeys.includes(currentWeekKey)) {
            uniqueKeys.push(currentWeekKey);
            uniqueKeys.sort();
        }

        return uniqueKeys;
    }, [currentWeekKey, recentMatches, upcomingMatches]);

    const [activeWeekKey, setActiveWeekKey] = useState(currentWeekKey);

    const safeActiveWeekKey = weekKeys.includes(activeWeekKey) ? activeWeekKey : currentWeekKey;
    const activeWeekIndex = Math.max(0, weekKeys.indexOf(safeActiveWeekKey));

    const filteredUpcomingMatches = useMemo(
        () =>
            upcomingMatches.filter(
                (match) => toWeekStartKey(match.match_date) === safeActiveWeekKey,
            ),
        [safeActiveWeekKey, upcomingMatches],
    );

    const filteredRecentMatches = useMemo(
        () =>
            recentMatches.filter(
                (match) => toWeekStartKey(match.match_date) === safeActiveWeekKey,
            ),
        [recentMatches, safeActiveWeekKey],
    );

    const goToPreviousWeek = () => {
        if (activeWeekIndex <= 0) {
            return;
        }

        setActiveWeekKey(weekKeys[activeWeekIndex - 1]);
    };

    const goToNextWeek = () => {
        if (activeWeekIndex >= weekKeys.length - 1) {
            return;
        }

        setActiveWeekKey(weekKeys[activeWeekIndex + 1]);
    };

    return (
        <section className="kbc-ig-panel">
            <header className="kbc-matches-headline">
                <button
                    type="button"
                    aria-label="Previous week"
                    onClick={goToPreviousWeek}
                    disabled={activeWeekIndex <= 0}
                >
                    &#10094;
                </button>
                <div>
                    <h1>Matches</h1>
                    <p>{formatWeekRangeLabel(safeActiveWeekKey)}</p>
                </div>
                <button
                    type="button"
                    aria-label="Next week"
                    onClick={goToNextWeek}
                    disabled={activeWeekIndex >= weekKeys.length - 1}
                >
                    &#10095;
                </button>
            </header>

            <MatchCardsSection
                title="Upcoming Matches"
                matches={filteredUpcomingMatches}
                emptyMessage="Belum ada jadwal pertandingan terdekat."
            />

            <MatchCardsSection
                title="Recent Results"
                matches={filteredRecentMatches}
                emptyMessage="Belum ada hasil pertandingan."
            />
        </section>
    );
}

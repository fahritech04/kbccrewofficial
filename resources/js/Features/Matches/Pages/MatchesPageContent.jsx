import MatchCardsSection from '../Components/MatchCardsSection';
import { formatMatchDayLabel } from '../../Site/utils/date';

export default function MatchesPageContent({ upcomingMatches, recentMatches }) {
    const featuredMatchDate =
        upcomingMatches[0]?.match_date ??
        recentMatches[0]?.match_date ??
        new Date().toISOString();

    return (
        <section className="kbc-ig-panel">
            <header className="kbc-matches-headline">
                <button type="button" aria-label="Previous matchday">
                    &#10094;
                </button>
                <div>
                    <h1>Matches</h1>
                    <p>{formatMatchDayLabel(featuredMatchDate)}</p>
                </div>
                <button type="button" aria-label="Next matchday">
                    &#10095;
                </button>
            </header>

            <MatchCardsSection
                title="Upcoming Matches"
                matches={upcomingMatches}
                emptyMessage="Belum ada jadwal pertandingan terdekat."
            />

            <MatchCardsSection
                title="Recent Results"
                matches={recentMatches}
                emptyMessage="Belum ada hasil pertandingan."
            />
        </section>
    );
}

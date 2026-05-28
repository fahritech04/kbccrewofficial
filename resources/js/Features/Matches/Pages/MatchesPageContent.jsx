import MatchCardsSection from '../Components/MatchCardsSection';

export default function MatchesPageContent({ upcomingMatches, recentMatches }) {
    return (
        <section className="kbc-ig-panel">
            <header className="kbc-ig-head">
                <div>
                    <h1>Matches</h1>
                    <p>Jadwal pertandingan berikutnya dan hasil terbaru kompetisi.</p>
                </div>
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

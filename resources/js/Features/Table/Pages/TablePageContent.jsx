import StandingsFullTable from '../../Site/Components/StandingsFullTable';

export default function TablePageContent({ standings, leader }) {
    return (
        <section className="kbc-ig-panel">
            <header className="kbc-ig-head">
                <div>
                    <h1>Table</h1>
                    <p>Klasemen resmi Kotabaru Basketball Competition.</p>
                </div>
            </header>

            <StandingsFullTable standings={standings} leader={leader} />
        </section>
    );
}

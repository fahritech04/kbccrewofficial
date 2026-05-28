export default function TablePageContent({ standings, leader }) {
    return (
        <section className="kbc-ig-panel">
            <header className="kbc-ig-head">
                <div>
                    <h1>Table</h1>
                    <p>Klasemen resmi Kotabaru Basketball Competition.</p>
                </div>
            </header>

            {leader && (
                <p className="kbc-ig-status is-info">
                    Posisi puncak saat ini: <strong>{leader.team.name}</strong> ({leader.points} poin).
                </p>
            )}

            <section className="kbc-table-card">
                <div className="kbc-table-head">
                    <h2>Full Standings</h2>
                </div>

                <div className="kbc-table-list">
                    {standings.map((standing) => (
                        <div key={standing.id} className="kbc-table-row">
                            <p>{standing.position}</p>
                            <div>
                                <strong>{standing.team.short_name ?? standing.team.name}</strong>
                            </div>
                            <p>{standing.played}</p>
                            <p>
                                {standing.point_diff > 0
                                    ? `+${standing.point_diff}`
                                    : standing.point_diff}
                            </p>
                            <p>{standing.points}</p>
                        </div>
                    ))}
                </div>
            </section>
        </section>
    );
}

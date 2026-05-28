function StatCard({ label, value }) {
    return (
        <article className="kbc-match-card">
            <p className="kbc-round">{label}</p>
            <div className="kbc-match-teams">
                <strong>{value}</strong>
            </div>
        </article>
    );
}

export default function StatisticsPageContent({ summary, topOffense, topDefense, topPointDiff }) {
    return (
        <section className="kbc-ig-panel">
            <header className="kbc-ig-head">
                <div>
                    <h1>Statistics</h1>
                    <p>Ringkasan statistik kompetisi berbasis data pertandingan aktual.</p>
                </div>
            </header>

            <div className="kbc-match-grid">
                <StatCard label="Total Matches" value={summary.total_matches} />
                <StatCard label="Scheduled" value={summary.scheduled_matches} />
                <StatCard label="Live" value={summary.live_matches} />
                <StatCard label="Finished" value={summary.finished_matches} />
                <StatCard label="Avg Total Points" value={summary.average_total_points} />
            </div>

            {(topOffense || topDefense) && (
                <section className="kbc-section">
                    <div className="kbc-section-head">
                        <h2>Team Leaders</h2>
                    </div>
                    <div className="kbc-match-grid">
                        {topOffense && (
                            <article className="kbc-match-card">
                                <p className="kbc-round">Best Offense</p>
                                <div className="kbc-match-teams">
                                    <span>{topOffense.team.short_name}</span>
                                    <strong>{topOffense.points_for}</strong>
                                </div>
                            </article>
                        )}
                        {topDefense && (
                            <article className="kbc-match-card">
                                <p className="kbc-round">Best Defense</p>
                                <div className="kbc-match-teams">
                                    <span>{topDefense.team.short_name}</span>
                                    <strong>{topDefense.points_against}</strong>
                                </div>
                            </article>
                        )}
                    </div>
                </section>
            )}

            {topPointDiff.length > 0 && (
                <section className="kbc-table-card">
                    <div className="kbc-table-head">
                        <h2>Top Point Differential</h2>
                    </div>

                    <div className="kbc-table-list">
                        {topPointDiff.map((standing) => (
                            <div key={standing.id} className="kbc-table-row">
                                <p>{standing.position}</p>
                                <div>
                                    <strong>{standing.team.short_name}</strong>
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
            )}
        </section>
    );
}

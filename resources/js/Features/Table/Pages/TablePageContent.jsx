function buildForm(standing) {
    const played = standing.played ?? 0;
    const won = standing.won ?? 0;
    const lost = standing.lost ?? 0;
    const drawn = Math.max(0, played - won - lost);

    const pool = [
        ...Array.from({ length: won }, () => 'W'),
        ...Array.from({ length: drawn }, () => 'D'),
        ...Array.from({ length: lost }, () => 'L'),
    ];

    const lastFive = pool.slice(-5);

    while (lastFive.length < 5) {
        lastFive.unshift('D');
    }

    return lastFive;
}

export default function TablePageContent({ standings, leader }) {
    return (
        <section className="kbc-ig-panel">
            <header className="kbc-ig-head">
                <div>
                    <h1>Table</h1>
                    <p>Klasemen resmi Kotabaru Basketball Competition.</p>
                </div>
            </header>

            <section className="kbc-standings-table">
                <div className="kbc-standings-scroll">
                    <div className="kbc-standings-head">
                        <p>Pos</p>
                        <p>Team</p>
                        <p>Pl</p>
                        <p>W</p>
                        <p>D</p>
                        <p>L</p>
                        <p>GF</p>
                        <p>GA</p>
                        <p>GD</p>
                        <p>Pts</p>
                        <p>Form</p>
                    </div>

                    <div className="kbc-standings-body">
                        {standings.map((standing) => {
                            const form = buildForm(standing);
                            const draws = Math.max(
                                0,
                                (standing.played ?? 0) -
                                    (standing.won ?? 0) -
                                    (standing.lost ?? 0),
                            );

                            return (
                                <article key={standing.id} className="kbc-standings-row">
                                    <p className="kbc-standings-pos">{standing.position}</p>

                                    <div className="kbc-standings-team">
                                        {standing.team.logo_url && (
                                            <img
                                                src={standing.team.logo_url}
                                                alt={standing.team.short_name}
                                            />
                                        )}
                                        <strong>{standing.team.name}</strong>
                                    </div>

                                    <p>{standing.played}</p>
                                    <p>{standing.won}</p>
                                    <p>{draws}</p>
                                    <p>{standing.lost}</p>
                                    <p>{standing.points_for}</p>
                                    <p>{standing.points_against}</p>
                                    <p>
                                        {standing.point_diff > 0
                                            ? `+${standing.point_diff}`
                                            : standing.point_diff}
                                    </p>
                                    <p className="kbc-standings-points">{standing.points}</p>

                                    <div className="kbc-standings-form">
                                        {form.map((item, index) => (
                                            <span
                                                key={`${standing.id}-${item}-${index}`}
                                                className={`kbc-form-badge is-${item.toLowerCase()}`}
                                            >
                                                {item}
                                            </span>
                                        ))}
                                    </div>
                                </article>
                            );
                        })}
                    </div>
                </div>
                {leader && (
                    <p className="kbc-standings-note">
                        Puncak klasemen saat ini: <strong>{leader.team.name}</strong> (
                        {leader.points} poin).
                    </p>
                )}
            </section>
        </section>
    );
}

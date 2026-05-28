import { buildRecentForm, calculateDraws, formatPointDiff } from '../utils/standings';

export default function StandingsFullTable({ standings, leader }) {
    return (
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
                    {standings.map((standing) => (
                        <article key={standing.id} className="kbc-standings-row">
                            <p className="kbc-standings-pos">{standing.position}</p>

                            <div className="kbc-standings-team">
                                {standing.team.logo_url && (
                                    <img src={standing.team.logo_url} alt={standing.team.short_name} />
                                )}
                                <strong>{standing.team.name}</strong>
                            </div>

                            <p>{standing.played}</p>
                            <p>{standing.won}</p>
                            <p>{calculateDraws(standing)}</p>
                            <p>{standing.lost}</p>
                            <p>{standing.points_for}</p>
                            <p>{standing.points_against}</p>
                            <p>{formatPointDiff(standing.point_diff)}</p>
                            <p className="kbc-standings-points">{standing.points}</p>

                            <div className="kbc-standings-form">
                                {buildRecentForm(standing).map((item, index) => (
                                    <span
                                        key={`${standing.id}-${item}-${index}`}
                                        className={`kbc-form-badge is-${item.toLowerCase()}`}
                                    >
                                        {item}
                                    </span>
                                ))}
                            </div>
                        </article>
                    ))}
                </div>
            </div>

            {leader && (
                <p className="kbc-standings-note">
                    Puncak klasemen saat ini: <strong>{leader.team.name}</strong> ({leader.points}{' '}
                    poin).
                </p>
            )}
        </section>
    );
}

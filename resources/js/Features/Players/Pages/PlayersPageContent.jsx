import { SITE_FALLBACK_IMAGE } from '../../Site/constants';

export default function PlayersPageContent({ spotlightTeams, stories }) {
    return (
        <section className="kbc-ig-panel">
            <header className="kbc-ig-head">
                <div>
                    <h1>Players</h1>
                    <p>Spotlight performa tim dan stories terbaru terkait pemain.</p>
                </div>
            </header>

            {spotlightTeams.length > 0 && (
                <section className="kbc-table-card">
                    <div className="kbc-table-head">
                        <h2>Spotlight Teams</h2>
                    </div>

                    <div className="kbc-table-list">
                        {spotlightTeams.map((standing) => (
                            <div key={standing.id} className="kbc-table-row">
                                <p>{standing.position}</p>
                                <div>
                                    <strong>{standing.team.short_name}</strong>
                                </div>
                                <p>{standing.won}-{standing.lost}</p>
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

            {stories.length > 0 && (
                <section className="kbc-section">
                    <div className="kbc-section-head">
                        <h2>Latest Stories</h2>
                    </div>
                    <div className="kbc-card-grid">
                        {stories.map((story) => (
                            <article key={story.id} className="kbc-media-card">
                                <img src={story.image_url ?? SITE_FALLBACK_IMAGE} alt={story.title} />
                                <div className="kbc-media-content">
                                    <p>{story.title}</p>
                                    <span>{story.category}</span>
                                </div>
                            </article>
                        ))}
                    </div>
                </section>
            )}
        </section>
    );
}

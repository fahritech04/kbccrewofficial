import { resolveImageUrl } from '../../Site/utils/media';
import StandingsCompactRows from '../../Site/Components/StandingsCompactRows';

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

                    <StandingsCompactRows
                        standings={spotlightTeams}
                        thirdColumnValue={(standing) => `${standing.won}-${standing.lost}`}
                    />
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
                                <img src={resolveImageUrl(story.image_url)} alt={story.title} />
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

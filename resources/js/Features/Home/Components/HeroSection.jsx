export default function HeroSection({ featuredNews, heroNews, standings, fallbackImage }) {
    return (
        <main className="kbc-hero-grid">
            <section className="kbc-main-card">
                <img
                    src={featuredNews?.image_url ?? fallbackImage}
                    alt={featuredNews?.title}
                    className="kbc-main-image"
                />

                <div className="kbc-main-content">
                    <p className="kbc-kicker">{featuredNews?.category ?? 'News'}</p>
                    <h1>{featuredNews?.title}</h1>
                    <p>{featuredNews?.excerpt}</p>
                </div>
            </section>

            <section className="kbc-news-rail">
                {heroNews.map((item) => (
                    <article key={item.id} className="kbc-news-item">
                        <div>
                            <p className="kbc-news-category">{item.category}</p>
                            <h3>{item.title}</h3>
                        </div>
                        <img src={item.image_url ?? fallbackImage} alt={item.title} />
                    </article>
                ))}
            </section>

            <section className="kbc-table-card">
                <div className="kbc-table-head">
                    <h2>Table</h2>
                    <button type="button">View full table</button>
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
        </main>
    );
}


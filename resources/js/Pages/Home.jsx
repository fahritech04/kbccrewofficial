import { Head } from "@inertiajs/react";
import { useState } from "react";

const formatDate = (date) =>
    new Date(date).toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "short",
    });

const formatTime = (date) =>
    new Date(date).toLocaleTimeString("id-ID", {
        hour: "2-digit",
        minute: "2-digit",
    });

const fallbackImage =
    "https://images.unsplash.com/photo-1504450758481-7338eba7524a?auto=format&fit=crop&w=1200&q=80";

function buildCardsFromNews(news, count, section) {
    if (!news?.length) {
        return [];
    }

    return Array.from({ length: count }, (_, index) => {
        const item = news[index % news.length];
        return {
            id: `${section}-${item.id}-${index}`,
            title: item.title,
            category: item.category,
            image: item.image_url ?? fallbackImage,
        };
    });
}

function MediaSection({ title, cards }) {
    return (
        <section className="pl-section">
            <div className="pl-section-head">
                <h2>{title}</h2>
                <a href="#">View more</a>
            </div>
            <div className="pl-card-grid">
                {cards.map((card) => (
                    <article key={card.id} className="pl-media-card">
                        <img src={card.image} alt={card.title} />
                        <div className="pl-media-content">
                            <p>{card.title}</p>
                            <span>{card.category}</span>
                        </div>
                    </article>
                ))}
            </div>
            <div className="pl-center-btn-wrap">
                <button type="button">View More</button>
            </div>
        </section>
    );
}

export default function Home({ featuredNews, news, standings, matches }) {
    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);

    const heroNews = news?.slice(0, 4) ?? [];
    const sectionCards = {
        moments: buildCardsFromNews(news, 6, "moments"),
        features: buildCardsFromNews(news, 8, "features"),
        awards: buildCardsFromNews(news, 6, "awards"),
        champions: buildCardsFromNews(news, 8, "champions"),
        clubs: buildCardsFromNews(news, 6, "clubs"),
        quizzes: buildCardsFromNews(news, 5, "quizzes"),
    };
    const partners = [
        ["EA SPORTS FC", "Lead Partner"],
        ["Adobe", "Official Creativity Partner"],
        ["Barclays", "Official Bank"],
        ["Coca-Cola", "Official Soft Drink"],
        ["Guinness", "Official Beer"],
        ["Microsoft", "Official Cloud & AI Partner"],
        ["Puma", "Official Ball"],
        ["Avery Dennison", "Official Licensee"],
        ["Football Manager", "Official Licensee"],
        ["Rezzil", "Official Licensee"],
        ["Sorare", "Official Licensee"],
        ["Topps", "Official Licensee"],
    ];

    return (
        <>
            <Head title="Kotabaru Basketball Competition" />

            <div className="pl-shell">
                <header className="pl-microbar">
                    <div className="pl-micro-links">
                        <a href="#">Kotabaru Basketball Competition</a>
                        <a href="#">Shop</a>
                        <a href="#">About Us</a>
                        <a href="#">Football & Community</a>
                        <a href="#">Events</a>
                        <a href="#">Media</a>
                        <a href="#">The Archive</a>
                    </div>
                    <a href="#">Presented by @kbccrewofficial</a>
                </header>

                <header className="pl-topbar">
                    <div className="pl-topbar-left">
                        <button
                            type="button"
                            className="pl-menu-btn"
                            aria-label="Open menu"
                            aria-expanded={isMobileMenuOpen}
                            onClick={() => setIsMobileMenuOpen((prev) => !prev)}
                        >
                            &#9776;
                        </button>
                        <div className="pl-brand">
                            <div className="pl-brand-mark">K</div>
                            <div>
                                <p className="pl-brand-name">Kotabaru</p>
                                <p className="pl-brand-tag">
                                    Basketball Competition
                                </p>
                            </div>
                        </div>
                    </div>

                    <nav
                        className={`pl-nav ${isMobileMenuOpen ? "is-open" : ""}`}
                    >
                        <a href="#" onClick={() => setIsMobileMenuOpen(false)}>
                            Matches
                        </a>
                        <a href="#" onClick={() => setIsMobileMenuOpen(false)}>
                            Table
                        </a>
                        <a href="#" onClick={() => setIsMobileMenuOpen(false)}>
                            Statistics
                        </a>
                        <a href="#" onClick={() => setIsMobileMenuOpen(false)}>
                            Players
                        </a>
                        <a href="#" onClick={() => setIsMobileMenuOpen(false)}>
                            Clubs
                        </a>
                        <a href="#" onClick={() => setIsMobileMenuOpen(false)}>
                            Instagram
                        </a>
                    </nav>

                    <div className="pl-topbar-right">
                        <button type="button" className="pl-signin-btn">
                            Sign in
                        </button>
                    </div>
                </header>

                <div className="pl-content-wrap">
                    <div className="pl-alert">
                        <span>Latest:</span> Kotabaru Hawks pastikan tiket
                        playoff usai kemenangan dramatis pekan ini.
                    </div>

                    <main className="pl-hero-grid">
                        <section className="pl-main-card">
                            <img
                                src={featuredNews?.image_url ?? fallbackImage}
                                alt={featuredNews?.title}
                                className="pl-main-image"
                            />

                            <div className="pl-main-content">
                                <p className="pl-kicker">
                                    {featuredNews?.category ?? "News"}
                                </p>
                                <h1>{featuredNews?.title}</h1>
                                <p>{featuredNews?.excerpt}</p>
                            </div>
                        </section>

                        <section className="pl-news-rail">
                            {heroNews.map((item) => (
                                <article key={item.id} className="pl-news-item">
                                    <div>
                                        <p className="pl-news-category">
                                            {item.category}
                                        </p>
                                        <h3>{item.title}</h3>
                                    </div>
                                    <img
                                        src={item.image_url ?? fallbackImage}
                                        alt={item.title}
                                    />
                                </article>
                            ))}
                        </section>

                        <section className="pl-table-card">
                            <div className="pl-table-head">
                                <h2>Table</h2>
                                <button type="button">View full table</button>
                            </div>

                            <div className="pl-table-list">
                                {standings.map((standing) => (
                                    <div
                                        key={standing.id}
                                        className="pl-table-row"
                                    >
                                        <p>{standing.position}</p>
                                        <div>
                                            <strong>
                                                {standing.team.short_name ??
                                                    standing.team.name}
                                            </strong>
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

                    <section className="pl-sponsor-strip">
                        {[
                            "Adidas",
                            "Coca-Cola",
                            "Nike",
                            "Microsoft",
                            "Puma",
                            "Molten",
                        ].map((sponsor) => (
                            <div key={sponsor} className="pl-sponsor">
                                {sponsor}
                            </div>
                        ))}
                    </section>

                    <section className="pl-section">
                        <div className="pl-section-head">
                            <h2>Kotabaru Match Centre</h2>
                        </div>
                        <div className="pl-match-grid">
                            {matches.map((match) => (
                                <article
                                    key={match.id}
                                    className="pl-match-card"
                                >
                                    <p className="pl-round">{match.round}</p>
                                    <div className="pl-match-teams">
                                        <span>
                                            {match.home_team.short_name}
                                        </span>
                                        <strong>{match.scoreboard}</strong>
                                        <span>
                                            {match.away_team.short_name}
                                        </span>
                                    </div>
                                    <p className="pl-match-info">
                                        {formatDate(match.match_date)} |{" "}
                                        {formatTime(match.match_date)}
                                    </p>
                                    <p className="pl-match-info">
                                        {match.venue}
                                    </p>
                                </article>
                            ))}
                        </div>
                    </section>

                    <MediaSection
                        title="Unmissable Moments"
                        cards={sectionCards.moments}
                    />
                    <MediaSection
                        title="News & Features"
                        cards={sectionCards.features}
                    />
                    <MediaSection title="Awards" cards={sectionCards.awards} />
                    <MediaSection
                        title="Champions Feed"
                        cards={sectionCards.champions}
                    />
                    <MediaSection
                        title="From The Clubs"
                        cards={sectionCards.clubs}
                    />
                    <MediaSection
                        title="Games, Quizzes & Polls"
                        cards={sectionCards.quizzes}
                    />

                    <footer className="pl-footer">
                        <section className="pl-footer-partners">
                            <div className="pl-footer-partner-grid">
                                {partners.map(([brand, role]) => (
                                    <article
                                        key={brand}
                                        className="pl-footer-partner-card"
                                    >
                                        <h3>{brand}</h3>
                                        <p>{role}</p>
                                    </article>
                                ))}
                            </div>
                        </section>

                        <section className="pl-footer-links">
                            <div className="pl-footer-link-col">
                                <a href="#">Kotabaru Basketball Competition</a>
                                <a href="#">Fantasy</a>
                                <a href="#">Matches</a>
                            </div>
                            <div className="pl-footer-link-col">
                                <a href="#">Table</a>
                                <a href="#">Statistics</a>
                                <a href="#">Latest News</a>
                            </div>
                            <div className="pl-footer-link-col">
                                <a href="#">Latest Video</a>
                                <a href="#">Clubs</a>
                                <a href="#">Players</a>
                            </div>
                        </section>

                        <section className="pl-footer-bottom">
                            <p>© Kotabaru Basketball Competition 2026</p>
                            <div className="pl-footer-bottom-links">
                                <a href="#">Terms of Use</a>
                                <a href="#">Policies</a>
                                <a href="#">Cookie Policy</a>
                                <a href="#">Contact Us</a>
                                <a href="#">Back To Top</a>
                            </div>
                            <p>Kotabaru Basketball Competition</p>
                        </section>
                    </footer>
                </div>
            </div>
        </>
    );
}

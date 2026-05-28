export default function MediaSection({ title, cards }) {
    return (
        <section className="kbc-section">
            <div className="kbc-section-head">
                <h2>{title}</h2>
                <a href="#">View more</a>
            </div>
            <div className="kbc-card-grid">
                {cards.map((card) => (
                    <article key={card.id} className="kbc-media-card">
                        <img src={card.image} alt={card.title} />
                        <div className="kbc-media-content">
                            <p>{card.title}</p>
                            <span>{card.category}</span>
                        </div>
                    </article>
                ))}
            </div>
            <div className="kbc-center-btn-wrap">
                <button type="button">View More</button>
            </div>
        </section>
    );
}


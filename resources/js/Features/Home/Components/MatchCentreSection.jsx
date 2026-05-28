export default function MatchCentreSection({ matches, formatDate, formatTime }) {
    return (
        <section className="kbc-section">
            <div className="kbc-section-head">
                <h2>Kotabaru Match Centre</h2>
            </div>
            <div className="kbc-match-grid">
                {matches.map((match) => (
                    <article key={match.id} className="kbc-match-card">
                        <p className="kbc-round">{match.round}</p>
                        <div className="kbc-match-teams">
                            <span>{match.home_team.short_name}</span>
                            <strong>{match.scoreboard}</strong>
                            <span>{match.away_team.short_name}</span>
                        </div>
                        <p className="kbc-match-info">
                            {formatDate(match.match_date)} | {formatTime(match.match_date)}
                        </p>
                        <p className="kbc-match-info">{match.venue}</p>
                    </article>
                ))}
            </div>
        </section>
    );
}


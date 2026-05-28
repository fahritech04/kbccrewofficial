import { SITE_FALLBACK_IMAGE } from '../../Site/constants';

export default function ClubsPageContent({ clubs }) {
    return (
        <section className="kbc-ig-panel">
            <header className="kbc-ig-head">
                <div>
                    <h1>Clubs</h1>
                    <p>Profil klub peserta Kotabaru Basketball Competition.</p>
                </div>
            </header>

            {clubs.length === 0 ? (
                <p className="kbc-ig-status is-info">Data klub belum tersedia.</p>
            ) : (
                <div className="kbc-card-grid">
                    {clubs.map((club) => (
                        <article key={club.id} className="kbc-media-card">
                            <img src={club.logo_url ?? SITE_FALLBACK_IMAGE} alt={club.name} />
                            <div className="kbc-media-content">
                                <p>{club.name}</p>
                                <span>
                                    {club.city} | {club.matches_count} matches
                                </span>
                            </div>
                        </article>
                    ))}
                </div>
            )}
        </section>
    );
}

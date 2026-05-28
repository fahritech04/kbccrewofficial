import InstagramPanelHeader from '../Components/InstagramPanelHeader';
import InstagramPostsGrid from '../Components/InstagramPostsGrid';
import InstagramProfileSummary from '../Components/InstagramProfileSummary';

export default function InstagramPageContent({ instagram }) {
    const profile = instagram?.profile ?? {};
    const posts = instagram?.posts ?? [];

    return (
        <section className="kbc-ig-panel">
            <InstagramPanelHeader profile={profile} />

            {!instagram?.is_live && instagram?.message && (
                <p className="kbc-ig-status">{instagram.message}</p>
            )}

            <InstagramProfileSummary profile={profile} />
            <InstagramPostsGrid posts={posts} />
        </section>
    );
}

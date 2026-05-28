import { INSTAGRAM_EMPTY_POSTS_MESSAGE } from '../constants';
import InstagramPostCard from './InstagramPostCard';

export default function InstagramPostsGrid({ posts }) {
    if (!posts.length) {
        return <p className="kbc-ig-status">{INSTAGRAM_EMPTY_POSTS_MESSAGE}</p>;
    }

    return (
        <div className="kbc-ig-grid">
            {posts.map((post) => (
                <InstagramPostCard key={post.id} post={post} />
            ))}
        </div>
    );
}

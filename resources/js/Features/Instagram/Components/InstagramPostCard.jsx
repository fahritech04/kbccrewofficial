import { INSTAGRAM_NO_COMMENTS_MESSAGE } from '../constants';
import { toProxyImageUrl, trimText } from '../utils';

export default function InstagramPostCard({ post }) {
    return (
        <article className="kbc-ig-card">
            <a href={post.permalink} target="_blank" rel="noreferrer">
                <img
                    src={toProxyImageUrl(post.image_url)}
                    alt={post.caption ?? 'Instagram post'}
                />
            </a>

            <div className="kbc-ig-card-body">
                <p className="kbc-ig-caption">{trimText(post.caption)}</p>
                <p className="kbc-ig-metrics">
                    ? {post.like_count ?? 0} · ?? {post.comments_count ?? 0}
                </p>

                {post.comments?.length > 0 ? (
                    <div className="kbc-ig-comments">
                        {post.comments.slice(0, 2).map((comment) => (
                            <p key={comment.id}>
                                <strong>@{comment.username}</strong>{' '}
                                {trimText(comment.text, 80)}
                            </p>
                        ))}
                    </div>
                ) : (
                    <p className="kbc-ig-no-comments">
                        {INSTAGRAM_NO_COMMENTS_MESSAGE}
                    </p>
                )}
            </div>
        </article>
    );
}

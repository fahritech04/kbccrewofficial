import { INSTAGRAM_DEFAULT_USERNAME } from '../constants';
import { toProxyImageUrl } from '../utils';

export default function InstagramProfileSummary({ profile }) {
    return (
        <div className="kbc-ig-profile">
            {profile.profile_picture_url ? (
                <img
                    src={toProxyImageUrl(profile.profile_picture_url)}
                    alt={profile.username}
                />
            ) : (
                <div className="kbc-ig-avatar">IG</div>
            )}

            <div>
                <h2>@{profile.username ?? INSTAGRAM_DEFAULT_USERNAME}</h2>
                <p>
                    {profile.followers_count ?? '-'} followers · {profile.media_count ?? '-'} posts
                </p>
            </div>
        </div>
    );
}

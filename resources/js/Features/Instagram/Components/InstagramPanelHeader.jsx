import {
    INSTAGRAM_DEFAULT_USERNAME,
    INSTAGRAM_PROFILE_URL,
    INSTAGRAM_SECTION_TITLE,
} from '../constants';

export default function InstagramPanelHeader({ profile }) {
    return (
        <div className="kbc-ig-head">
            <div>
                <h1>{INSTAGRAM_SECTION_TITLE}</h1>
                <p>
                    Postingan dan komentar terbaru dari @
                    {profile.username ?? INSTAGRAM_DEFAULT_USERNAME}
                </p>
            </div>
            <a
                className="kbc-ig-visit"
                href={profile.profile_url ?? INSTAGRAM_PROFILE_URL}
                target="_blank"
                rel="noreferrer"
            >
                Kunjungi Instagram
            </a>
        </div>
    );
}

import { INSTAGRAM_PAGE_TITLE } from '../Features/Instagram/constants';
import InstagramPageContent from '../Features/Instagram/Pages/InstagramPageContent';
import PublicPageLayout from '../Features/Site/Layouts/PublicPageLayout';

export default function Instagram({ instagram }) {
    return (
        <PublicPageLayout title={INSTAGRAM_PAGE_TITLE}>
            <InstagramPageContent instagram={instagram} />
        </PublicPageLayout>
    );
}

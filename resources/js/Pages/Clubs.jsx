import { CLUBS_PAGE_TITLE } from '../Features/Clubs/constants';
import ClubsPageContent from '../Features/Clubs/Pages/ClubsPageContent';
import PublicPageLayout from '../Features/Site/Layouts/PublicPageLayout';

export default function Clubs({ clubs }) {
    return (
        <PublicPageLayout title={CLUBS_PAGE_TITLE}>
            <ClubsPageContent clubs={clubs ?? []} />
        </PublicPageLayout>
    );
}

import { TABLE_PAGE_TITLE } from '../Features/Table/constants';
import TablePageContent from '../Features/Table/Pages/TablePageContent';
import PublicPageLayout from '../Features/Site/Layouts/PublicPageLayout';

export default function Table({ standings, leader }) {
    return (
        <PublicPageLayout title={TABLE_PAGE_TITLE}>
            <TablePageContent standings={standings ?? []} leader={leader} />
        </PublicPageLayout>
    );
}

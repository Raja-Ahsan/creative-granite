<?php

namespace App\Http\Controllers\Admin;

class ServiceAreaController extends ServiceGuideController
{
    protected bool $isServiceArea = true;

    protected string $routeName = 'admin.service-areas';

    protected string $indexTitle = 'Service Area';

    protected string $createTitle = 'Add Service Area Page';

    protected string $editTitle = 'Edit Service Area Page';

    protected string $createdMessage = 'Service area page created.';

    protected string $updatedMessage = 'Service area page updated.';

    protected string $deletedMessage = 'Service area page deleted.';

    protected string $emptyMessage = 'No service area pages yet.';

    protected string $addButtonLabel = 'Add Service Area Page';

    protected string $deleteConfirm = 'Delete this service area page?';
}

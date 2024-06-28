<?php require_once 'Includes/header.tpl.php' ?>
    <body>
    <div class="container-fluid vh-100 p-5">
        <div class="row mb-2">
            <h3 class="text-center text-danger">Error</h3>
        </div>
        <div class="row h-auto border border-danger-subtle bg-danger-subtle">
            <div class="col p-4">
                <p class="m-0 mb-2">
                    <strong class="text-danger">Error code:</strong>
                    <?php echo $exception->getCode(); ?>
                </p>
                <p class="m-0 mb-2">
                    <strong class="text-danger">Message:</strong>
                    <?php echo '"' . $exception->getMessage() . '"'; ?>
                </p>
                <p class="m-0 mb-2">
                    <strong class="text-danger">File:</strong>
                    <?php echo '"' . $exception->getFile() . '"'; ?>
                </p>
                <p class="m-0 mb-2">
                    <strong class="text-danger">Trace:</strong>
                    <?php echo '"' . $exception->getTraceAsString() . '"'; ?>
                </p>
            </div>
        </div>
    </div>
    </body>
<?php require_once 'Includes/footer.tpl.php' ?>
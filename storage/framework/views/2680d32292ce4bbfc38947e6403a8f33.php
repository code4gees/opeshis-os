<?php $__env->startSection('title', 'Access Denied'); ?>
<?php $__env->startSection('code', '403'); ?>
<?php $__env->startSection('message', 'Unauthorized Access'); ?>
<?php $__env->startSection('description', 'Your current credentials do not have the necessary permissions to access this modular terminal. Please contact your system administrator.'); ?>

<?php echo $__env->make('errors.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\opeshis\resources\views\errors\403.blade.php ENDPATH**/ ?>
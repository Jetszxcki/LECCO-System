<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>

    <?php if(session('status')): ?>
        <div id="flash-msg" class="alert alert-success text-center ls-2 mx-3" role="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <div class="d-flex flex-wrap scrolling-wrapper">
        

        <?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'user_view_list')): ?>
            <?php echo $__env->make('partials.home_panel', ['header' => 'USERS', 'href' => 'users.index', 'image' => 'user.jpg'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'member_view_list')): ?>
            <?php echo $__env->make('partials.home_panel', ['header' => 'MEMBERS', 'href' => 'members.index', 'image' => 'user.jpg'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'loans_view_list')): ?>
            <?php echo $__env->make('partials.home_panel', ['header' => 'LOANS', 'href' => 'loans.index', 'image' => 'user.jpg'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'loan_types_view_list')): ?>
            <?php echo $__env->make('partials.home_panel', ['header' => 'LOAN TYPES', 'href' => 'loan_types.index', 'image' => 'user.jpg'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'shares_view_list')): ?>
            <?php echo $__env->make('partials.home_panel', ['header' => 'SHARES', 'href' => 'shares.index', 'image' => 'user.jpg'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        

        <?php if (\Illuminate\Support\Facades\Blade::check('accessright', 'signatories_view_list')): ?>
            <?php echo $__env->make('partials.home_panel', ['header' => 'SIGNATORIES', 'href' => 'signatories.index', 'image' => 'user.jpg'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        
        




    <script type="text/javascript">
        // const buttonScroll = function () {
        //     const scroll = function (width, direction) {
        //         event.preventDefault();
        //         let widthText = '';

        //         if (direction === 'right') {
        //             widthText = '+=' + width + 'px';
        //             $('#draggable-div').animate({
        //                 scrollLeft: widthText,
        //             }, "slow");
        //         } else if (direction === 'left') {
        //             widthText = '-=' + width + 'px';
        //             $('#draggable-div').animate({
        //                 scrollLeft: widthText,
        //             }, "slow");
        //         }
        //     }

        //     $('#right-scroll-btn').click(function() {
        //         scroll($('#draggable-div').width(),'right');
        //     });

        //      $('#left-scroll-btn').click(function() {
        //         scroll($('#draggable-div').width(), 'left');
        //     });
        // }

        // const mouseDragScroll = function () {
        //     const slider = document.getElementById('draggable-div');
        //     let isDown = false;
        //     let startX;
        //     let scrollLeft;

        //     slider.addEventListener('mouseleave', function() {
        //         isDown = false;
        //     }); 

        //     slider.addEventListener('mouseup', function() {
        //         isDown = false;
        //     }); 

        //     slider.addEventListener('mousedown', function(e) {
        //         isDown = true;
        //         startX = e.pageX - slider.offsetLeft;
        //         scrollLeft = slider.scrollLeft;
        //     }); 

        //     slider.addEventListener('mousemove', function(e) {
        //         if (!isDown) return;
        //         e.preventDefault();
        //         const x = e.pageX - slider.offsetLeft;
        //         const walk = (x - startX) * 1.5;
        //         slider.scrollLeft = scrollLeft - walk;
        //     }); 
        // }

        const flashTimer = function () {
            setTimeout(function() { 
               $('#flash-msg').fadeOut(); 
           }, 3000);
        }

        window.addEventListener('load', function() {
            // buttonScroll();
            // mouseDragScroll();
            flashTimer();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/home.blade.php ENDPATH**/ ?>
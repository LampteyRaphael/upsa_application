<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
    <b class=" tect-center text-uppercase">UNIVERSITY - </b>
        <span class="brand-text"><b>IPS</b></span>
    </a>
    <div class="sidebar">
    <div class="ml-5 mt-3 pb-3 mb-3 d-flex">
            <div class="image ml-3">
            </div>
        </div>
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => 
                [
                    ['label' => 'Dashboard', 'url'=>['/student/default/default'], 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    ['label' => 'Student Bio Data', 'url'=>['/student/default/index'], 'icon' => 'user'],
                    ['label' => 'Course Registration',  'icon' => 'fa fa-pen', 'url' => ['/student/tbl-course/index']],
                    ['label' => 'Registered Courses', 'url' => ['/student/tbl-st-registration/index'], 'icon' => 'fa fa-book'],
                    ['label' => 'Examination Results',  'icon' => 'fa fa-share-square', 'url' => ['/student/tbl-st-registration/result']],
                    ['label' => 'Add Comment',  'icon' => 'fa fa-comment', 'url' => ['/student/default/comment']],
                    ['label' => 'Comments',  'icon' => 'comments', 'url' => ['/student/default/reply']],
                    
                ],
            ]);
            ?>
        </nav>
    </div>
</aside>
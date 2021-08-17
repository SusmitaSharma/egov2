<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->




        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="treeview  @if(request()->is('admin')) active    @endif"><a href="{{route('admin_home')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>


            <li class="treeview @if(request()->is('admin/company') || request()->is('admin/feedback')) active @endif">
                <a href="#">
                    <i class="fa fa-building"></i><span> परिचय</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu " style="">
                   <!--  <li class="{{request()->is('admin/officeSetup*')? 'active':''}}"><a href=""><i class="fa fa-circle-o"></i>स‌क्षिप्त परिचय</a></li> -->
                    <li class="{{request()->is('admin/feedback')? 'active':''}}"><a href="{{route('feedback.index')}}"><i class="fa fa-circle-o"></i>सुझाव व्यवस्थापन</a></li>
                    <li class="{{request()->is('admin/company')? 'active':''}}"><a href="{{route('company.index')}}"><i class="fa fa-circle-o"></i> कार्यालय ठेगाना</a></li>

                </ul>
            </li>


            <li class="treeview @if(request()->is('admin/designation*') || request()->is('admin/user*')) active @endif">
                <a href="#">
                    <i class="fa fa-table fa-fw"></i><span> कर्मचारी विवरण </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu " style="">
                    <li class="{{request()->is('admin/user*')? 'active':''}}"><a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i>कर्मचारी</a></li>
                    <li class="{{request()->is('admin/designation*')? 'active':''}}"><a href="{{route('designation.index')}}"><i class="fa fa-circle-o"></i>पद</a></li>


                </ul>
            </li>

           <!--  <li class="treeview @if(request()->is('admin/karyala*')) active @endif">
                <a href="#">
                    <i class="fa fa-group fa-fw"></i><span>कार्यालय अधिकारी </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu " style="">
                    <li class=""><a href=""><i class="fa fa-circle-o"></i>मुख्य अधिकारी </a></li>

                </ul>
            </li> -->

            <li class="treeview @if(request()->is('admin/gallery*') || request()->is('admin/photo*')  || request()->is('admin/slider*')) active @endif">
                <a href="#">
                    <i class="fa fa-photo  fa-fw"></i><span> ग्यालरी</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu " style="">
                    <li class="{{request()->is('admin/gallery')? 'active':''}}"><a href="{{route('gallery.index')}}"><i class="fa fa-circle-o"></i>ऐलिबम</a></li>
                    <li class="{{request()->is('admin/photo')? 'active':''}}"><a href="{{route('photo.index')}}"><i class="fa fa-circle-o"></i>फाेटाेहरु </a></li>
                    <li class="{{request()->is('admin/slider*')? 'active':''}}"><a href="{{route('slider.index')}}"><i class="fa fa-circle-o"></i>बहिरहने फाेटाे (Slide)</a></li>


                </ul>
            </li>


            <!-- <li class=""><a href="{{route('admin_home')}}"> <i class="fa fa-copy fa-fw"></i><span> नागरिक वडापत्र</span></a></li>
             -->

            <!-- <li class="treeview @if(request()->is('admin/officeSetup*') || request()->is('admin/user*')  || request()->is('admin/checklist*')) active @endif">
                <a href="#">
                    <i class="fa fa-industry  fa-fw"></i><span> सेवा प्रवाह सम्बन्धि विवरण</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu " style="">
                    <li class="{{request()->is('admin/officeSetup*')? 'active':''}}"><a href=""><i class="fa fa-circle-o"></i>तथ्याङ्गक सम्बन्धि विवरण</a></li>
                    <li class="{{request()->is('admin/officeSetup*')? 'active':''}}"><a href=""><i class="fa fa-circle-o"></i>वार्षिक प्रगति विवरण</a></li>


                </ul>
            </li>
 -->
           <!--  <li class="treeview @if(request()->is('admin/officeSetup*') || request()->is('admin/user*')  || request()->is('admin/checklist*')) active @endif">
                <a href="#">
                    <i class="fa fa-laptop  fa-fw"></i><span>  विद्वयतीय सुशासन</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu " style="">
                    <li class="{{request()->is('admin/officeSetup*')? 'active':''}}"><a href=""><i class="fa fa-circle-o"></i>प्रोएक्टिभ सूचना</a></li>
                    <li class="{{request()->is('admin/officeSetup*')? 'active':''}}"><a href=""><i class="fa fa-circle-o"></i>नमुना फारम</a></li>
                </ul>
            </li> -->

            <li class="treeview @if(request()->is('admin/news*') || request()->is('admin/notice*')  || request()->is('admin/publication*')) active @endif">
                <a href="#">
                    <i class="fa fa-newspaper-o fa-fw"></i><span>  सूचना तथा समाचार</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu " style="">
                    <li class="{{request()->is('admin/news*')? 'active':''}}"><a href="{{route('news.index')}}"><i class="fa fa-circle-o"></i>समाचार</a></li>
                    <li class="{{request()->is('admin/notice*')? 'active':''}}"><a href="{{route('notice.index')}}"><i class="fa fa-circle-o"></i>सूचना</a></li>
                    <li class="{{request()->is('admin/publication*')? 'active':''}}"><a href="{{route('publication.index')}}"><i class="fa fa-circle-o"></i>प्रकाशन</a></li>
                </ul>
            </li>

           <!--  <li class="treeview @if(request()->is('admin/officeSetup*') || request()->is('admin/user*')  || request()->is('admin/checklist*')) active @endif">
                <a href="#">
                    <i class="fa fa-play-circle-o"></i><span> मिडिया</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu " style="">
                    <li class="{{request()->is('admin/officeSetup*')? 'active':''}}"><a href=""><i class="fa fa-circle-o"></i> प्रेस विज्ञप्ती</a></li>

                </ul>
            </li> -->

            <li class="treeview @if(request()->is('admin/download*')) active @endif">
                <a href="#">
                    <i class="fa fa-download fa-fw"></i><span>विविध</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu " style="">
                    <li class="{{request()->is('admin/notification*')? 'active':''}}"><a href="{{route('notification.index')}}"><i class="fa fa-circle-o"></i>Notification</a></li>

                    <li class="{{request()->is('admin/download*')? 'active':''}}"><a href="{{route('download.index')}}"><i class="fa fa-circle-o"></i>डाउनलोड </a></li>
                    <li class="{{request()->is('admin/update*')? 'active':''}}"><a href="{{route('update.index')}}"><i class="fa fa-circle-o"></i>अपडेट </a></li>
                </ul>
            </li>

            <li class="treeview @if(request()->is('admin/download*')) active @endif">
                <a href="#">
                    <i class="fa fa-download fa-fw"></i><span>Pages</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu " style="">
                    <li class="{{request()->is('admin/page*')? 'active':''}}"><a href="{{route('page.index')}}"><i class="fa fa-files-o"></i>Page</a></li>

                    <li class="{{request()->is('admin/pageType*')? 'active':''}}"><a href="{{route('pageType.index')}}"><i class="fa fa-circle-o"></i>Page Type</a></li>                </ul>
            </li>
            <li class="{{request()->is('admin/menu*')? 'active':''}}"><a href="{{route('menu.index')}}"><i class="fa fa-circle-o"></i> मेनू </a></li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

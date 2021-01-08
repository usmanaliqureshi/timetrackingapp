<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $profile_img; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $name; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <!--form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li <?php echo ("/dashboard.php" == $_SERVER['PHP_SELF']) ? 'class="active"' : ""; ?>>
                <a href="dashboard.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li <?php echo ("/tracktime.php" == $_SERVER['PHP_SELF']) ? 'class="active"' : ""; ?>>
                <a href="tracktime.php">
                    <i class="fa fa-clock-o"></i>
                    <span>Track Time</span>
                </a>
            </li>
            <li <?php echo ("/timelog.php" == $_SERVER['PHP_SELF']) ? 'class="active"' : ""; ?>>
                <a href="timelog.php">
                    <i class="fa fa-book"></i>
                    <span>Time Logged</span>
                </a>
            </li>
            <li <?php echo ("/profile.php" == $_SERVER['PHP_SELF']) ? 'class="active"' : ""; ?>>
                <a href="profile.php">
                    <i class="fa fa-user-o"></i>
                    <span>Profile</span>
                </a>
            </li>
        </ul>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

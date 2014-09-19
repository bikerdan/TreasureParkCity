<?php
/*
Template Name: Documentation 
*/
?>
<?php
    // Load up dropdown items
    $visual = $wpdb->get_results("SELECT file_name, title FROM tpc_submittal_docs WHERE type = 'visualization'");
    $engineering = $wpdb->get_results("SELECT file_name, title FROM tpc_submittal_docs WHERE type = 'arch/eng index 1'");
    $architectural = $wpdb->get_results("SELECT file_name, title FROM tpc_submittal_docs WHERE type = 'arch/eng index 2'");
    $appendices = $wpdb->get_results("SELECT file_name, title FROM tpc_submittal_docs WHERE type = 'appendices'");

    // Check if form was submitted
    if (!empty($_POST['fs'])) {
        $sheet = $_POST['sheet'];
        $title = $_POST['title'];
        $date = $_POST['date'];
        $sql = "SELECT file_name, title FROM tpc_submittal_docs WHERE 1=1";
        $where = '';
        if (!empty($sheet) || !empty($title) || !empty($date)) {
            if (!empty($sheet)) {
                $sheet = mysql_real_escape_string($sheet);
                $where .= " AND sheet_number LIKE '%$sheet%'";
            }
            if (!empty($title)) {
                $title = mysql_real_escape_string($title);
                $where .= " AND title LIKE '%$title%'";
            }
            if (!empty($date)) {
                $date = mysql_real_escape_string($date);
                $where .= " AND date LIKE '%$date%'";
            }
            $search_result = $wpdb->get_results($sql.$where);
            //var_dump($search_result);exit($sql.$where);
        }
    }
?>

<?php get_header(); ?>
<div id="standard-template-body">
    <article id="content">
        <div class="page-header"><?php strToUpper(the_title()); ?></div>
        <hr class="gallery-sample-hr" />
        <?php the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
                <div class="search-box">
                    <form class="form-horizontal" role="form" method="POST">
                        <input type="hidden" name="fs" value='1'/>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Search By</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control search-input" name="sheet" id="inputSheetNum" placeholder="Sheet #">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control search-input" name="title" id="inputTitle" placeholder="Description/Name">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control search-input" name="date" id="inputDate" placeholder="Date">
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn search-btn btn-default">Search</button>
                            </div>
                        </div>
                        <hr class="gallery-sample-hr">
                        <div class="row">
                            <div class="col-md-2" style="text-align: right"><label for="inputEmail3" class="control-label">Browse</label></div>
                            <div class="col-md-5">
                                <div class="dropdown">
                                    <button type="button" class="btn search-dropdown btn-default dropdown-toggle" data-toggle="dropdown">
                                        Visual Drawing Index&nbsp;&nbsp;<div class="arrow-down"></div>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <?php
                                        $item = '<li role="presentation"><a role="menuitem" target="_blank" href="/wp-content/docs/%s">%s</a></li>';
                                        foreach ($visual as $k => $record) {
                                            printf($item, $record->file_name, $record->title);
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="dropdown">
                                    <button type="button" class="btn search-dropdown btn-default dropdown-toggle" data-toggle="dropdown">
                                        Engineering Index&nbsp;&nbsp;<div class="arrow-down"></div>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        <?php
                                        $item = '<li role="presentation"><a role="menuitem" target="_blank" href="/wp-content/docs/%s">%s</a></li>';
                                        foreach ($engineering as $k => $record) {
                                            printf($item, $record->file_name, $record->title);
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <div class="dropdown">
                                    <button type="button" class="btn search-dropdown btn-default dropdown-toggle" data-toggle="dropdown">
                                        Architectural Drawing Index&nbsp;&nbsp;<div class="arrow-down"></div>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        <?php
                                        $item = '<li role="presentation"><a role="menuitem" target="_blank" href="/wp-content/docs/%s">%s</a></li>';
                                        foreach ($architectural as $k => $record) {
                                            printf($item, $record->file_name, $record->title);
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="dropdown">
                                    <button type="button" class="btn search-dropdown btn-default dropdown-toggle" data-toggle="dropdown">
                                        Appendices&nbsp;&nbsp;<div class="arrow-down"></div>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        <?php
                                        $item = '<li role="presentation"><a role="menuitem" target="_blank" href="/wp-content/docs/%s">%s</a></li>';
                                        foreach ($appendices as $k => $record) {
                                            printf($item, $record->file_name, $record->title);
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="search-results-box">
                    <br><br>
                    <?php
                    if (!empty($search_result)) {
                    ?>
                        <ul>
                            <?php
                            $item = '<li role="presentation" class="search-result-li"><a role="menuitem" target="_blank" href="/wp-content/docs/%s">%s</a></li>';
                            foreach ($search_result as $k => $record) {
                                printf($item, $record->file_name, $record->title);
                            }
                            ?>
                        </ul>
                        <!-- <table class="search-result-table">
                            <tr><td>File Name</td></tr>
                            <?php
                            // $item = '<tr><td><a role="menuitem" target="_blank" href="/wp-content/docs/%s">%s</a></td></tr>';
                            // foreach ($search_result as $k => $record) {
                            //     printf($item, $record->file_name, $record->title);
                            // }
                            ?>
                        </table> -->
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </article>
    <?php include("sidebar.php"); ?>
</div>
<?php 
    get_footer(); 
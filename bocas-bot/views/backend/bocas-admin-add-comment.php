<div class="wrap">
    <div class="container theme-showcase" role="main">
        <div class="jumbotron">
            <h1>Add Comment</h1>
            <br>
            <p>In this view you can auto schedule a single comment.</p>
        </div>
        <div class="panel panel-default bocas-background-color-panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="admin-post.php" class="form-inline">
                            <input type="hidden" name="action" value="bocas_admin_add_comment" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-md-5">
                                        <label for="name">Post:</label>
                                        <select class="form-control" name="post" id="post" required>
                                            <?php
                                                if(isset($posts) && !is_null($posts)) {
                                                    foreach($posts as $key => $value) {
                                                        ?>
                                                            <option value="<?php echo esc_html($value->ID); ?>"
                                                                    data-post-id="<?php echo esc_html($value->ID); ?>"
                                                            ><?php echo esc_html($value->ID.' - '.$value->post_title); ?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="user-agent">User Agent:</label>
                                        <select class="form-control" name="user-agent" id="user-agent" required>
                                            <?php
                                            if(isset($userAgents) && !is_null($userAgents)) {
                                                foreach($userAgents as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo esc_html($key); ?>"
                                                            data-ua-id="<?php echo esc_html($key); ?>"
                                                    ><?php echo esc_html($key); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                                <div class="col-md-12">
                                    <div class="form-group col-md-4">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Jane Doe" style="width:80%" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="jane.doe@example.com" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="web">Web:</label>
                                        <input type="text" class="form-control" id="web" name="web" placeholder="http://gorkamu.com" required>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-md-4">
                                        <label for="ip">IP:</label>
                                        <input type="text" class="form-control" id="ip" name="ip" placeholder="89.172.32.103" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date">Date:</label>
                                        <input type="text" class="form-control" id="date" name="date" placeholder="21-12-1989" required>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="date">Status:</label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="1">Approved</option>
                                            <option value="0" selected>Awaiting</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="date">Content:</label>
                                        <textarea class="form-control" rows="3" cols="120" name="content" id="content" required></textarea>
                                    </div>
                                    <br><br>
                                    <span>The name, email, web and content field could be used with spintax format.</span>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-block">Submit data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .form-inline .form-group { margin-right: 3% !important;}
            label { margin-right: 5px; }
        </style>
    </div>
</div>
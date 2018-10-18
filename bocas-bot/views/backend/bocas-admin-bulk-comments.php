<div class="wrap">
    <div class="container theme-showcase" role="main">
        <div class="panel panel-default bocas-background-color-panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <span>
                            <strong>Header & Format:</strong>
                            postId,name,email,web,ip,date,content,status,user-agent
                        </span>
                        <br>
                        <span>
                            <strong>Example:</strong>
                            <i>28,{Jacinto|Maria|Ainhoa},jacinto@gmail.com,http://google.com,192.168.1.100,18-09-1989,{texto|contenido|parrafo} spineado,0,Mozilla/5.0</i>
                        </span>
                        <br>
                        <span>
                            <strong>Escape character:</strong>
                            <i>\r</i>
                        </span>
                        <br>
                        <span>
                            <strong>Separator:</strong>
                            <i>,</i>
                        </span>
                        <br>
                        <span>
                            <strong>User agent strings:</strong>
                            <a href="http://www.useragentstring.com/pages/useragentstring.php" rel="nofollow" target="_blank">link</a>
                        </span>
                        <br><br>
                        <span><strong>The header is required</strong> and the author, email, url and content field could be used with spintax format.</span>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="admin-post.php" class="form-inline" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="bocas_admin_bulk_comments" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="csv">CSV:</label>
                                        <textarea class="form-control" rows="10" cols="133" name="csv" id="csv"
                                            placeholder="postId,name,email,web,ip,date,content,status,user-agent&#x0a;28,{Jacinto|Maria|Ainhoa},jacinto@gmail.com,http://google.com,192.168.1.100,18-09-1989,{texto|contenido|parrafo} spineado,0,Mozilla/5.0&#x0a;29,{Jacinto|Maria|Ainhoa},jacinto@gmail.com,http://google.com,192.168.1.100,18-09-1989,{texto|contenido|parrafo} spineado,0,Mozilla/5.0&#x0a;30,{Jacinto|Maria|Ainhoa},jacinto@gmail.com,http://google.com,192.168.1.100,18-09-1989,{texto|contenido|parrafo} spineado,0,Mozilla/5.0&#x0a;31,{Jacinto|Maria|Ainhoa},jacinto@gmail.com,http://google.com,192.168.1.100,18-09-1989,{texto|contenido|parrafo} spineado,0,Mozilla/5.0"
                                        ></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top:3%">
                                    <label for="file">Select a CSV file</label>
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Submit data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Url</th>
                <th>Content</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($comments) && !is_null($comments)) {
                foreach($comments as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo esc_html($value->comment_author); ?></td>
                        <td><?php echo esc_html($value->comment_author_email); ?></td>
                        <td><?php echo explode(" ", esc_html($value->comment_date))[0]; ?></td>
                        <td><?php echo esc_html($value->comment_author_url); ?></td>
                        <td><?php echo esc_html($value->comment_content); ?></td>
                        <td><?php echo esc_html($value->comment_approved); ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
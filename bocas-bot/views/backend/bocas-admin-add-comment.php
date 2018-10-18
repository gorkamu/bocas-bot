<div class="wrap">
    <div class="container theme-showcase" role="main">

        <div class="panel panel-default bocas-background-color-panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="admin-post.php" class="form-inline">
                            <input type="hidden" name="action" value="bocas_admin_add_comment" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-md-5">
                                        <label for="name">Profile:</label>
                                        <select class="form-control" name="profile" id="profile">
                                            <option value=""
                                                    data-profile-id=""
                                                    data-profile-name=""
                                                    data-profile-author=""
                                                    data-profile-email=""
                                                    data-profile-web=""
                                                    data-profile-content=""> -- </option>
                                            <?php
                                            if(isset($profiles) && !is_null($profiles)) {
                                                foreach($profiles as $profile) {
                                                    ?>
                                                    <option value="<?php echo esc_html($profile->id); ?>"
                                                            data-profile-id="<?php echo esc_html($profile->id); ?>"
                                                            data-profile-name="<?php echo esc_html($profile->name); ?>"
                                                            data-profile-author="<?php echo esc_html($profile->author); ?>"
                                                            data-profile-email="<?php echo esc_html($profile->email); ?>"
                                                            data-profile-web="<?php echo esc_html($profile->web); ?>"
                                                            data-profile-content="<?php echo esc_html($profile->content); ?>"
                                                    ><?php echo esc_html($profile->name); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
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
                                        <select class="form-control" name="user-agent" id="user-agent" required style="width: 79%;">
                                            <?php
                                            if(isset($userAgents) && !is_null($userAgents)) {
                                                foreach($userAgents as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo esc_html($value->name); ?>"
                                                            data-ua-id="<?php echo esc_html($value->name); ?>"
                                                    ><?php echo esc_html($value->user_agent); ?></option>
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
                                        <input type="text" class="form-control" id="email" name="email" placeholder="jane.doe@example.com" required>
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
                                        <button type="button" class="btn btn-default" id="generate_ip_btn">
                                            <svg style="display: inline-block; cursor: pointer; height:1em; width:1em;top:.125em; position: relative;" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M666 481q-60 92-137 273-22-45-37-72.5t-40.5-63.5-51-56.5-63-35-81.5-14.5h-224q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h224q250 0 410 225zm1126 799q0 14-9 23l-320 320q-9 9-23 9-13 0-22.5-9.5t-9.5-22.5v-192q-32 0-85 .5t-81 1-73-1-71-5-64-10.5-63-18.5-58-28.5-59-40-55-53.5-56-69.5q59-93 136-273 22 45 37 72.5t40.5 63.5 51 56.5 63 35 81.5 14.5h256v-192q0-14 9-23t23-9q12 0 24 10l319 319q9 9 9 23zm0-896q0 14-9 23l-320 320q-9 9-23 9-13 0-22.5-9.5t-9.5-22.5v-192h-256q-48 0-87 15t-69 45-51 61.5-45 77.5q-32 62-78 171-29 66-49.5 111t-54 105-64 100-74 83-90 68.5-106.5 42-128 16.5h-224q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h224q48 0 87-15t69-45 51-61.5 45-77.5q32-62 78-171 29-66 49.5-111t54-105 64-100 74-83 90-68.5 106.5-42 128-16.5h256v-192q0-14 9-23t23-9q12 0 24 10l319 319q9 9 9 23z"/></svg>
                                        </button>
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
                                    <span>The <i>name, email, web and content</i> field could be used with <a
                                                href="http://gorkamu.com/2018/10/como-spinear-un-texto/#Spintax_anidado_o_en_3_dimensiones" target="_blank">spintax 3d format</a> too.</span>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Add comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="wp-list-table widefat fixed striped comments">
            <thead>
            <tr>
                <th scope="col" id="author" class="manage-column column-author" style="width: 18%"><span>Author</span></th>
                <th scope="col" id="comment" class="manage-column column-comment">Comment</th>
                <th scope="col" id="response" class="manage-column column-response"><span>In reply to</span></th>
                <th scope="col" id="date" class="manage-column column-date"><span>Submitted on</span></th>
            </tr>
            </thead>
            <tbody id="the-comment-list" data-wp-lists="list:comment">
            <?php
                if(isset($comments) && !is_null($comments)) {
                    foreach($comments as $key => $value) {

            ?>
                <tr id="comment-<?php echo esc_html($value->comment_ID); ?>" class="comment even thread-even depth-1 approved">
                    <td class="author column-author" data-colname="Autor">
                        <strong>
                            <img alt=""
                                 src="http://0.gravatar.com/avatar/36599ddecac54011bd670626bacf745a?s=32&amp;d=mm&amp;r=g"
                                 srcset="http://0.gravatar.com/avatar/36599ddecac54011bd670626bacf745a?s=64&amp;d=mm&amp;r=g 2x"
                                 class="avatar avatar-32 photo" height="32" width="32"/>
                            <?php echo esc_html($value->comment_author); ?>
                        </strong>
                        <br>
                        <a target="_blank" href="<?php echo esc_html($value->comment_author_url); ?>"><?php echo esc_html($value->comment_author_url); ?></a>
                        <br>
                        <a><?php echo esc_html($value->comment_author_email); ?></a>
                        <br>
                        <a><?php echo esc_html($value->comment_author_IP); ?></a>
                    </td>

                    <td class="comment column-comment has-row-actions column-primary" data-colname="Comment">
                        <p><?php echo esc_html($value->comment_content); ?></p>
                        <div class="row-actions"><span class="approve"><a href="comment.php?c=21&amp;action=approvecomment&amp;_wpnonce=5ca5537d6a" data-wp-lists="dim:the-comment-list:comment-21:unapproved:e7e7d3:e7e7d3:new=approved" class="vim-a" aria-label="Aprobar este comentario">Aprobar</a></span><span class="unapprove"><a href="comment.php?c=21&amp;action=unapprovecomment&amp;_wpnonce=5ca5537d6a" data-wp-lists="dim:the-comment-list:comment-21:unapproved:e7e7d3:e7e7d3:new=unapproved" class="vim-u" aria-label="Rechazar este comentario">Rechazar</a></span><span class="reply hide-if-no-js"> | <a data-comment-id="21" data-post-id="1" data-action="replyto" class="vim-r comment-inline" aria-label="Responder a este comentario" href="#">Responder</a></span><span class="quickedit hide-if-no-js"> | <a data-comment-id="21" data-post-id="1" data-action="edit" class="vim-q comment-inline" aria-label="Edición rápida integrada de este comentario" href="#">Edición rápida</a></span><span class="edit"> | <a href="comment.php?action=editcomment&amp;c=21" aria-label="Editar este comentario">Editar</a></span><span class="spam"> | <a href="comment.php?c=21&amp;action=spamcomment&amp;_wpnonce=5ff8071bf6" data-wp-lists="delete:the-comment-list:comment-21::spam=1" class="vim-s vim-destructive" aria-label="Marcar este comentario como spam">Spam</a></span><span class="trash"> | <a href="comment.php?c=<?php echo esc_html($value->comment_ID); ?>&action=trashcomment&_wpnonce=5ff8071bf6" data-wp-lists="delete:the-comment-list:comment-<?php echo esc_html($value->comment_ID); ?>::trash=1" class="delete vim-d vim-destructive" aria-label="Mover este comentario a la papelera">Papelera</a></span></div>
                    </td>

                    <td class="response column-response" data-colname="En respuesta a">
                        <div class="response-links">
                            <a href="/wp-admin/post.php?post=<?php echo esc_html($value->ID); ?>&action=edit" class="comments-edit-item-link"><?php echo esc_html($value->post_title); ?></a>
                            <a href="<?php echo esc_html($value->guid); ?>" class="comments-view-item-link">Ver entrada</a>
                        </div>
                    </td>

                    <td class="date column-date" data-colname="Submitted on">
                        <div class="submitted-on">
                            <a href="<?php echo esc_html($value->guid); ?>#comment-<?php echo esc_html($value->comment_ID); ?>" target="_blank"><?php echo explode(" ", esc_html($value->comment_date))[0]; ?></a>
                        </div>
                    </td>
                </tr>
            <?php
                    }
                }
            ?>
            </tbody>
        </table>

        <style>
            .form-inline .form-group { margin-right: 3% !important;}
            label { margin-right: 5px; }
        </style>
    </div>
</div>
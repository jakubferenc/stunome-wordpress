jQuery(document).ready(function($){

    'use strict';

    var $btn_stop = $("#stunome-import-users-btn-stop");
    var $debuglist = $("#stunome-import__debuglist");
    var $debug_success_count = $("#stunome-debug-successcount");
    var $debug_fail_count = $("#stunome-debug-failurecount");
    var $progress_bar_percent = $("#stunome-bar-percent");

    var stunome_import_users_continue = true;

    var count_total = 0;

    var success_counter = 0;
    var fail_counter = 0;

    var users_array_to_import_global;

    function update_counter(status) {

        if ( status === "success" ) {

                success_counter++;
                $debug_success_count.html(success_counter);
                
        }

        if ( status === "fail" ) {

                fail_counter++;
                $debug_success_count.html(success_counter);
                
        }

    }

    function update_progress_bar() {

        $progress_bar_percent.css('width', ( ( success_counter +  fail_counter) / count_total ) * 100 + "%" );

    }

    function sendForImport(item) {

        var user_json = JSON.stringify(item);

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: { action: "stunome_import_users_action", user: user_json},

            success: function( response ) {

                $debuglist.append('<p class="response-box">' + response + '</p>');
          
                update_counter('success');

                if ( users_array_to_import_global.length && stunome_import_users_continue ) {

                    sendForImport( users_array_to_import_global.shift() );

                }

                update_progress_bar();

            },
            error: function( response ) {
     
                update_counter('fail');
                update_progress_bar();

            }

        });
    }

    function stunome_users_process_import(users_array_to_import) {

        count_total = users_array_to_import.length;

        users_array_to_import_global = users_array_to_import;

        if ( users_array_to_import_global.length && stunome_import_users_continue ) {

            sendForImport( users_array_to_import_global.shift() );

        }

    }

    $btn_stop.on('click', function() {
        
        var $this = $(this);

        if ( stunome_import_users_continue === true ) {

            // pause import
            stunome_import_users_continue = false;
            

        } else {

            // continue
            stunome_import_users_continue = true;

            if ( users_array_to_import_global.length && stunome_import_users_continue ) {

                sendForImport( users_array_to_import_global.shift() );

            }

        }

        $this.find('.stop-msg').toggleClass("hidden");
        $this.find('.continue-msg').toggleClass("hidden");
        

    });

    function app_init() {

        if ( $.isArray( window.users_to_import )  ) {

            stunome_users_process_import( window.users_to_import );

        }

    }


    app_init();

});
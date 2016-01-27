@servers(['web' => $user . '@' . $ip])
<?php //$user . '@' . domain ?>

@task('deploy')
    cd {{ $path }}
    if [ ! -d releases ]; then mkdir releases; fi
    echo 'blah'
@endtask

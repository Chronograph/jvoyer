@servers(['web' => $user . '@' . $ip])
<?php //$user . '@' . domain ?>

@task('deploygit')
    echo '--  Starting  --'
    if [ ! -d {{ $path }} ]; then
        echo 'No Directory found, creating {{ $path }}'
        mkdir {{ $path }}
    fi
    cd {{ $path }}
    if [ -L current ]; then
        echo 'Current symlink detected';
    else
        echo 'No current symlink detected'
        if [ -d current ]; then
            echo 'Removing any existing current directory'
            rm -r current
        fi
    fi
    if [ ! -d releases ]; then
        echo 'No Releases directory detected.'
        echo 'Creating releases directory.'
        mkdir releases; else echo 'Releases directory detected'
    fi
    cd releases
    git clone git://github.com{{$repo}}.git
    if [ -d {{$pname}} ]; then
        echo 'Repository cloned successfully.'
    else
        echo 'Error cloning repository.'
    fi
    if [ -d {{$pname}} ]; then
        echo 'Repository stored in {{$path}}/releases/{{ $time }}'
        mv {{ $pname }} {{ $time }}
    fi
    echo '--  Complete  --'

@endtask

@task('purgereleases')
    echo '--  Starting  --'
    cd {{ $path }}
    count=0
    keep={{ $keep }}

    for d in */ ; do
        ((count++))
    done
    echo 'Found $count total release directories'
    if [ $count -gt $keep ]; then
        echo 'Purging old directories'
        echo 'Keeping newest $keep releases'
    fi
    for d in */ ; do
        if [ $count -gt $keep ]; then
            rm -r $d
            ((count--))
        fi
    done
    echo '--  Complete  --'
@endtask

@task('activate')
    echo '--  Starting  --'
    cd {{ $path }}
    echo 'Activating release {{$path}}/releases/{{ $time }}'
    if [ -d releases/{{$time}} ]; then
        echo 'Linking to current'
        ln -sfn releases/{{$time}} current
    fi

    echo '--  Complete  --'
@endtask

@task('composer')
    echo '--  Starting  --'
    cd {{ $path }}
    cd releases
    cd {{ $time }}
    echo 'Running a composer install'
    composer install
    echo '--  Complete  --'
@endtask
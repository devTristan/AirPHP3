<?php

$list = get_included_files();

show::view('index.twig.html', array('list' => $list));

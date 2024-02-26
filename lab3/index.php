<?php

require_once "vendor/autoload.php";
session_start();

try {
    $visitor = new Visitor("is_counted");
    $counter = new VisitorCounter("visitor_count.txt");

    if (!$visitor->getIsCounted()) {
        $counter->incrementVisitorCount();
        $counter->saveCountInFile();
        $visitor->setIsCounted(true);
        $visitor->saveCountStatusInUserSession();
    }

    $countedUsers = $counter->getVisitorCount();
    echo "<h3> Counted Unique Visitors  : </h3> " . $countedUsers;
} catch (Exception $e) {
    echo "<p >**" . $e->getMessage() . "</p>";
    echo "<p>##" . $e->getTraceAsString() . "</p>";
}

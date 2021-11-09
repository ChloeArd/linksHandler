<?php
session_start();
session_unset();
session_destroy();
header("Location: ../../index.php?success=1&message=Vous%20êtes%20bien%20déconnecté(e).");
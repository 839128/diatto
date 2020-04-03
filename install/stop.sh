#!/bin/bash
php ../diatto/common/Plugins/GateWayWorker/start_register.php stop&
php ../diatto/common/Plugins/GateWayWorker/start_gateway.php stop&
php ../diatto/common/Plugins/GateWayWorker/start_businessworker.php stop;

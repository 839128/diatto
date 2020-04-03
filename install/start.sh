#!/bin/bash
php ../diatto/common/Plugins/GateWayWorker/start_register.php start&
php ../diatto/common/Plugins/GateWayWorker/start_gateway.php start&
php ../diatto/common/Plugins/GateWayWorker/start_businessworker.php start;

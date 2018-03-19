#! /bin/sh
### BEGIN INIT INFO
# Provides:          <your script name>
# Required-Start:    $all
# Required-Stop:
# Default-Start:     2 3 4 5
# Default-Stop:      0 1 6
# Short-Description: Manage my cool stuff
### END INIT INFO

PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/opt/bin

. /lib/init/vars.sh
. /lib/lsb/init-functions
# If you need to source some other scripts, do it here

case "$1" in
  start)
    log_begin_msg "gpio bootstrap script"
# do something
    echo "23" > /sys/class/gpio/export
    echo "out" > /sys/class/gpio/gpio23/direction

    log_end_msg $?
    exit 0
    ;;
  stop)
    log_begin_msg "Stopping service - gpio bootstrap script"

    # do something to kill the service or cleanup or nothing

    log_end_msg $?
    exit 0
    ;;
  *)
    echo "Usage: /etc/init.d/<your script> {start|stop}"
    exit 1
    ;;
esac
#!/bin/bash
HOST="seminole.dreamhost.com"
USER="useripsmade"
PASS="161PublicHost"
RCD="/Users/oivoodoo/projects/rubyforce/estates/design/flockcapital.com/"
LCD="/flockcapital.com/"
#DELETE="--delete"
lftp -c "set ftp:list-options -a;
open ftp://$USER:$PASS@$HOST;
lcd $LCD;
cd $RCD;
mirror --reverse \
  $DELETE \
  --verbose \
  --exclude-glob a-dir-to-exclude/ \
  --exclude-glob a-file-to-exclude \
  --exclude-glob a-file-group-to-exclude* \
  --exclude-glob other-files-to-exclude"


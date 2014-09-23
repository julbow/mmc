# -*- coding: utf-8; -*-
#
# (c) 2004-2007 Linbox / Free&ALter Soft, http://linbox.com
# (c) 2007-2014 Mandriva, http://www.mandriva.com
#
# This file is part of Mandriva Management Console (MMC).
#
# MMC is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# MMC is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with MMC.  If not, see <http://www.gnu.org/licenses/>.


import logging

from mmc.support.config import PluginConfig


class IDeskConfig(PluginConfig):

    def __init__(self, name="idesk", conffile=None):
        self.logger = logging.getLogger()
        if not hasattr(self, 'initdone'):
            PluginConfig.__init__(self, name, conffile)
            self.initdone = True

    def setDefault(self):

        PluginConfig.setDefault(self)

        self.base_url = "http://idesk-server/index.php/api/"


    def readConf(self):
        PluginConfig.readConf(self)

        self.base_url = self.safe_get("main",
                                       "base_url",
                                       self.base_url)


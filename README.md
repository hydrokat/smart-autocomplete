#----------------------------------------------------------#
# Developer : Argie Bacani                                 #
# Project Name: Smart Autocomplete (SMAC)                  #
# Description: This is a smart autocomplete helper         #
#              class written in PHP.                       #
#----------------------------------------------------------#

Database structure:

`tbl_smartautocomplete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fieldName` varchar(32) NOT NULL,
  `entry` varchar(32) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)

This simply counts the hits on the field name and the entry for that field name.

   _____                      _                   _                                  _      _       
  / ____|                    | |       /\        | |                                | |    | |      
 | (___  _ __ ___   __ _ _ __| |_     /  \  _   _| |_ ___   ___ ___  _ __ ___  _ __ | | ___| |_ ___ 
  \___ \| '_ ` _ \ / _` | '__| __|   / /\ \| | | | __/ _ \ / __/ _ \| '_ ` _ \| '_ \| |/ _ \ __/ _ \
  ____) | | | | | | (_| | |  | |_   / ____ \ |_| | || (_) | (_| (_) | | | | | | |_) | |  __/ ||  __/
 |_____/|_| |_| |_|\__,_|_|   \__| /_/    \_\__,_|\__\___/_\___\___/|_| |_| |_| .__/|_|\___|\__\___|
 | |            _                        | \ | |_| || |_ / _ \/_ |            | |                   
 | |__  _   _  (_)  _ __   __ _ _ __ __ _|  \| |_  __  _| | | || | __ _       |_|                   
 | '_ \| | | |     | '_ \ / _` | '__/ _` | . ` |_| || |_| | | || |/ _` |                            
 | |_) | |_| |  _  | |_) | (_| | | | (_| | |\  |_  __  _| |_| || | (_| |                            
 |_.__/ \__, | (_) | .__/ \__,_|_|  \__,_|_| \_| |_||_|  \___/ |_|\__,_|                            
         __/ |     | |                                                                              
        |___/      |_|                                                                              




This is a smart autocomplete helper class written in PHP.

Database structure:

`tbl_smartautocomplete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fieldName` varchar(32) NOT NULL,
  `entry` varchar(32) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)

This simply counts the hits on the field name and the entry for that field name.
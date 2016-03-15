<?php

    /**
     * 关于我们
     */
    class aboutModel
    {
        function aboutInfo()
        {
            return file_get_contents('about.md');
        }
    }

 ?>

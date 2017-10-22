<?php

namespace SimpleStaffList;

class Deactivator
{
    public function deactivate()
    {
        flush_rewrite_rules();
    }
}

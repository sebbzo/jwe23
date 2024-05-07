<?php

namespace WIFI\Jobportal\Fdb\Model\Row;
use WIFI\Jobportal\Fdb\Mysql;

class Job extends RowAbstract {
    protected string $tabelle = "jobs";

    public function get_kategorie(): Kategorie {

        // Die Kategorie ID wird geholt von dem aktuellen Job
        // Dann wird ein neues Kategorie Objekt erstellt, mit der passenden Kategorie-ID

        return new Kategorie($this->kategorie_id);
    }

    public function get_benutzer(): Benutzer {

        return new Benutzer($this->benutzer_id);
    }

    public function sichtbarkeit_umstellen($sichtbar): string {
        $db = Mysql::getInstanz();
        if ($sichtbar == "ja") {
            $sql_id = $db->escape($this->id);
            $db->query("UPDATE `jobs` SET `sichtbar`='nein' WHERE `id` = '{$sql_id}'");
        } else {
            $sql_id = $db->escape($this->id);
            $db->query("UPDATE `jobs` SET `sichtbar`='ja' WHERE `id` = '{$sql_id}'");
        }
        return true;
    }
}
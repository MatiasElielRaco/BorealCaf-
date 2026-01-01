<?php 

namespace Classes;


class Paginacion {
    public $pagina_actual;
    public $registros_por_pagina;
    public $total_registros;
    public $query_params; // string que contiene parametros adicionales (ej: &categoria=2&search=abc)

    public function __construct($pagina_actual = 1, $registros_por_pagina = 10, $total_registros = 0, $query_params = "")
    {
        $this->pagina_actual = (int) $pagina_actual;
        $this->registros_por_pagina = (int) $registros_por_pagina;
        $this->total_registros = (int) $total_registros;
        $this->query_params = $query_params ? (string) $query_params : "";
    }

    public function offset() {
        return ($this->pagina_actual > 0) ? ($this->pagina_actual - 1) * $this->registros_por_pagina : 0;
    }

    public function total_paginas() {
        return ceil($this->total_registros / $this->registros_por_pagina);
    }

    public function pagina_anterior() {
        $anterior = $this->pagina_actual - 1;
        return ($anterior > 0) ? $anterior : false;
    }

    public function pagina_siguiente() {
        $siguiente = $this->pagina_actual + 1;
        return ($siguiente <= $this->total_paginas()) ? $siguiente : false;
    }

    protected function buildQuery() {
        return $this->query_params ? '&' . ltrim($this->query_params, '&') : '';
    }

    public function enlace_anterior(){
        $html = "";
        if($this->pagina_anterior()){
            $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page={$this->pagina_anterior()}{$this->buildQuery()}\">&laquo; Anterior</a>";
        }
            return $html;
    }

    public function enlace_siguiente(){
        $html = "";
        if($this->pagina_siguiente()){
            $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page={$this->pagina_siguiente()}{$this->buildQuery()}\">Siguiente &raquo;</a>";
        }
            return $html;
    }

    public function numeros_paginas() {
        $html = "";
        for($i = 1; $i <= $this->total_paginas(); $i++) {
            if($i === $this->pagina_actual) {
                $html .= "<span class=\"paginacion__enlace paginacion__enlace--actual\">{$i}</span>";
            }else {
                $html .= "<a class=\"paginacion__enlace paginacion__enlace--numero\" href=\"?page={$i}{$this->buildQuery()}\">{$i}</a>";
            }
        }


        return $html;
    }

    public function paginacion() {
        $html = "";
        if($this->total_registros > 1) {
            $html .= '<div class="paginacion">';
            $html .= $this->enlace_anterior();
            $html .= $this->numeros_paginas();
            $html .= $this->enlace_siguiente();
            $html .= '</div>';
        }

        return $html;
    }
}
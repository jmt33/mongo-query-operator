<?php
/**
 * 封装Mongodb逻辑操作符实现方式
 */
class Logic
{
    public $options = [];

    /**
     * And逻辑
     * @param  Array $options 条件参数
     * @return Object
     */
    public function renderAnd($options)
    {
        $params = [];

        if (isset($this->options['$and'])) {
            $this->options['$and'][] = $options;
        } else {
            $this->options = array_merge($this->options, $options);
        }
        if (isset($this->options['$or'])) {
            foreach ($this->options as $key => $value) {
                $params['$and'][] = [
                    $key => $value
                ];
            }
            $this->options = $params;
        }
        return $this;
    }

    /**
     * Or逻辑
     * @param  Array $options 条件参数
     * @return Object
     */
    public function renderOr($options)
    {
        $params = [];
        $this->options = array_merge($this->options, $options);
        foreach ($this->options as $key => $value) {
            $params['$or'][] = [
                $key => $value
            ];
        }
        $this->options = $params;
        return $this;
    }

    /**
     * 得到最终结果
     * @return Array
     */
     public function result()
     {
         $options = $this->options;
         $this->options = [];
         $oprates = [
             '$and', '$or'
         ];
         foreach ($oprates as $oprate) {
             if (isset($options[$oprate])) {
                 $where = array_filter($options[$oprate]);
                 if (count($where) !== 1) {
                     $options[$oprate] = $where;
                 } else {
                     $options[$oprate] = $where;
                 }
             }
         }

         return $options;
     }
}

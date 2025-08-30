BEGIN
DECLARE v_existe INTEGER DEFAULT 0;
DECLARE v_cantidadrestar INTEGER DEFAULT 0;
DECLARE v_idinventarioreal INTEGER;
DECLARE v_iditem INTEGER;
DECLARE v_saldoreal INTEGER;
DECLARE v_restante INTEGER DEFAULT 0;


DECLARE fin INTEGER DEFAULT 0;

DECLARE runners_cursor CURSOR FOR 
    select c.stock,c.idproducto,c.idinventario from inventario_producto c where c.idproducto = v_idinventario and 
    c.stock<>0 order by c.fechaexpiracion asc;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin=1;
    SET v_cantidadrestar = v_cantidad;
    OPEN runners_cursor;
    get_runners: LOOP
    FETCH runners_cursor INTO v_saldoreal,v_iditem,v_idinventarioreal;
        IF fin = 1 THEN
           LEAVE get_runners;
        END IF;
        SET v_existe = 0;
        IF v_cantidadrestar <> 0 THEN
            IF v_saldoreal < (v_cantidadrestar) THEN
               SET v_existe = 1;
               SET v_cantidadrestar = v_cantidadrestar - v_saldoreal;
               UPDATE inventario_producto set stock = 0 where idinventario=v_idinventarioreal;
            END IF;
        END IF;
        IF v_existe = 0 THEN
            IF v_cantidadrestar <> 0 THEN
                IF v_saldoreal > (v_cantidadrestar) THEN
                    SET v_cantidadrestar = (v_saldoreal - v_cantidadrestar);
                    UPDATE inventario_producto set stock = v_cantidadrestar  where idinventario=v_idinventarioreal;
                    SET v_cantidadrestar = 0;
                END IF;
                IF v_saldoreal = (v_cantidadrestar) THEN
                    SET v_cantidadrestar = (v_saldoreal - v_cantidadrestar);
                    UPDATE inventario_producto set stock = v_cantidadrestar  where idinventario=v_idinventarioreal;
                END IF;
            END IF;
        END IF;
        
    END LOOP get_runners;
    CLOSE runners_cursor;
END
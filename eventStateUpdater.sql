
-- Este el el drop de la tarea programada que revisa que los eventos sigan siendo vigentes.
CREATE DEFINER=`user`@`localhost` EVENT `eventStateUpdater` ON SCHEDULE EVERY 1 MINUTE STARTS '2026-06-17 06:00:49' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE Sala SET Estado = 'FINALIZADA' WHERE Fecha < NOW() AND Estado = 'EN_PREPARACION'
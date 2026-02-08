import Button from "@/components/button";
import { ClipboardList, ArrowRight, RotateCcw } from "lucide-react";

export default function ResultActions({
  kelasId,
  materialId,
  nextMaterial,
  navigate,
  passed,
}) {
  return (
    <div className="mt-6 flex flex-col sm:flex-row gap-3 justify-center items-center">
      <Button
        variant="secondary"
        onClick={() => navigate(`/user/courses/${kelasId}/materials`)}
        className="px-6 py-3"
      >
        <ClipboardList size={20} />
        Kembali ke Materi
      </Button>

      {!passed && materialId && (
        <Button
          variant="primary"
          onClick={() =>
            navigate(`/user/courses/${kelasId}/materials/${materialId}/exam`)
          }
          className="px-6 py-3 flex items-center gap-2"
        >
          <RotateCcw size={16} />
          Coba Lagi
        </Button>
      )}

      {passed && nextMaterial && (
        <Button
          variant="primary"
          onClick={() =>
            navigate(`/user/courses/${kelasId}/materials/${nextMaterial.id}`)
          }
          className="px-6 py-3 flex items-center gap-2"
        >
          Lanjut ke Materi Berikutnya <ArrowRight size={16} />
        </Button>
      )}
    </div>
  );
}

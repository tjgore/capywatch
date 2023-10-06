export default function Loading() {
  return (
    <>
      {[...Array(5).keys()].map((block) => (
        <div key={block} className="border border-gray-300 rounded-md p-5">
          <div className="flex flex-col items-center mb-3">
            <div className="h-8 w-8 rounded-full animate-pulse bg-gray-200 mb-2"></div>
            <div className="animate-pulse h-5 w-2/12 rounded-full bg-gray-200 mb-4" />
            <div className="animate-pulse h-4 w-6/12 rounded-full bg-gray-200" />
          </div>
        </div>
      ))}
    </>
  );
}

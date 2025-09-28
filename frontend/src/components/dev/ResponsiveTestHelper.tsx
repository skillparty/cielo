'use client'

import { useState, useEffect } from 'react'
import { Monitor, Smartphone, Tablet } from 'lucide-react'

interface ViewportInfo {
  width: number
  height: number
  breakpoint: string
}

export default function ResponsiveTestHelper() {
  const [viewport, setViewport] = useState<ViewportInfo>({
    width: 0,
    height: 0,
    breakpoint: ''
  })
  const [isVisible, setIsVisible] = useState(false)

  useEffect(() => {
    const updateViewport = () => {
      const width = window.innerWidth
      const height = window.innerHeight
      
      let breakpoint = ''
      if (width < 375) breakpoint = 'xs'
      else if (width < 640) breakpoint = 'sm'
      else if (width < 768) breakpoint = 'md'
      else if (width < 1024) breakpoint = 'lg'
      else if (width < 1280) breakpoint = 'xl'
      else breakpoint = '2xl'

      setViewport({ width, height, breakpoint })
    }

    updateViewport()
    window.addEventListener('resize', updateViewport)
    return () => window.removeEventListener('resize', updateViewport)
  }, [])

  // Only show in development
  if (process.env.NODE_ENV !== 'development') {
    return null
  }

  return (
    <>
      {/* Toggle Button */}
      <button
        onClick={() => setIsVisible(!isVisible)}
        className="fixed bottom-4 right-4 z-[9999] bg-primary-700 text-white p-3 rounded-full shadow-lg hover:bg-primary-600 transition-colors"
        title="Toggle Responsive Helper"
      >
        <Monitor className="h-5 w-5" />
      </button>

      {/* Info Panel */}
      {isVisible && (
        <div className="fixed bottom-20 right-4 z-[9998] bg-white border border-neutral-200 rounded-lg shadow-xl p-4 min-w-[200px]">
          <div className="text-sm font-semibold text-neutral-900 mb-3">
            Responsive Info
          </div>
          
          <div className="space-y-2 text-xs">
            <div className="flex justify-between">
              <span className="text-neutral-600">Viewport:</span>
              <span className="font-mono">{viewport.width} × {viewport.height}</span>
            </div>
            
            <div className="flex justify-between">
              <span className="text-neutral-600">Breakpoint:</span>
              <span className={`font-semibold ${
                viewport.breakpoint === 'xs' ? 'text-red-600' :
                viewport.breakpoint === 'sm' ? 'text-orange-600' :
                viewport.breakpoint === 'md' ? 'text-yellow-600' :
                viewport.breakpoint === 'lg' ? 'text-green-600' :
                viewport.breakpoint === 'xl' ? 'text-blue-600' :
                'text-purple-600'
              }`}>
                {viewport.breakpoint}
              </span>
            </div>
          </div>

          <div className="mt-3 pt-3 border-t border-neutral-200">
            <div className="text-xs text-neutral-500 mb-2">Device Types:</div>
            <div className="flex space-x-2">
              <div className={`flex items-center space-x-1 px-2 py-1 rounded text-xs ${
                viewport.width < 768 ? 'bg-primary-100 text-primary-700' : 'bg-neutral-100 text-neutral-500'
              }`}>
                <Smartphone className="h-3 w-3" />
                <span>Mobile</span>
              </div>
              <div className={`flex items-center space-x-1 px-2 py-1 rounded text-xs ${
                viewport.width >= 768 && viewport.width < 1024 ? 'bg-primary-100 text-primary-700' : 'bg-neutral-100 text-neutral-500'
              }`}>
                <Tablet className="h-3 w-3" />
                <span>Tablet</span>
              </div>
              <div className={`flex items-center space-x-1 px-2 py-1 rounded text-xs ${
                viewport.width >= 1024 ? 'bg-primary-100 text-primary-700' : 'bg-neutral-100 text-neutral-500'
              }`}>
                <Monitor className="h-3 w-3" />
                <span>Desktop</span>
              </div>
            </div>
          </div>

          <div className="mt-3 pt-3 border-t border-neutral-200">
            <div className="text-xs text-neutral-500 mb-2">Breakpoint Guide:</div>
            <div className="space-y-1 text-xs">
              <div className="flex justify-between">
                <span className="text-red-600">xs:</span>
                <span className="font-mono">&lt; 375px</span>
              </div>
              <div className="flex justify-between">
                <span className="text-orange-600">sm:</span>
                <span className="font-mono">375px - 639px</span>
              </div>
              <div className="flex justify-between">
                <span className="text-yellow-600">md:</span>
                <span className="font-mono">640px - 767px</span>
              </div>
              <div className="flex justify-between">
                <span className="text-green-600">lg:</span>
                <span className="font-mono">768px - 1023px</span>
              </div>
              <div className="flex justify-between">
                <span className="text-blue-600">xl:</span>
                <span className="font-mono">1024px - 1279px</span>
              </div>
              <div className="flex justify-between">
                <span className="text-purple-600">2xl:</span>
                <span className="font-mono">&gt;= 1280px</span>
              </div>
            </div>
          </div>
        </div>
      )}
    </>
  )
}

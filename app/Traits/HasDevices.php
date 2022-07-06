<?php

namespace App\Traits;

use App\Models\Device;
use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

trait HasDevices
{
    /**
     * The device the user is using for the current request.
     */
    protected Device $device;

    /**
     * Get the devices that belong to model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function devices(): MorphMany
    {
        return $this->morphMany(Device::class, 'owner');
    }

    /**
     * Get the device currently associated with the user.
     */
    public function currentDevice(): Device
    {
        return $this->device;
    }

    /**
     * Set the current access token for the user.
     *
     * @param  \App\Models\Device  $device
     * @return $this
     */
    public function withDevice(Device $device): static
    {
        $this->device = $device;

        return $this;
    }

    /**
     * Get the QR code SVG of the user's two factor authentication QR code URL.
     *
     * @return string
     */
    public function XMSTokenSvg(): string
    {
        $svg = (new Writer(
            new ImageRenderer(
                new RendererStyle(192, 0, null, null, Fill::uniformColor(new Rgb(255, 255, 255), new Rgb(45, 55, 72))),
                new SvgImageBackEnd
            )
        ))->writeString($this->XMSTokenData());

        return trim(substr($svg, strpos($svg, "\n") + 1));
    }

    /**
     * Get the two factor authentication QR code URL.
     *
     * @return string
     */
    public function XMSTokenData(): string
    {
        $passHash = sha1($this->getAuthPassword());

        $this->tokens()->firstOrCreate(['name' => 'HotashXMS'], [
            'token' => hash('sha256', $passHash),
            'abilities' => ['*'],
        ]);

        return json_encode([
            'server' => config('app.url'),
            'token' => $passHash,
        ]);
    }
}

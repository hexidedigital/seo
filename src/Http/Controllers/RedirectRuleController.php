<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Controllers;

use Hexide\Seo\Facades\SeoHelper;
use Hexide\Seo\Http\Requests\RedirectRuleStoreRequest;
use Hexide\Seo\Http\Requests\RedirectRuleUpdateRequest;
use Hexide\Seo\Models\RedirectRule;

class RedirectRuleController extends Controller
{
    public function index()
    {
        $data = [
            'redirect_rules' => RedirectRule::all(),
        ];
        return view('seo::redirect_rules.index', $data);
    }

    public function create()
    {
        $data = [
            'model' => new RedirectRule(),
        ];
        return view('seo::redirect_rules.create', $data);
    }

    public function store(RedirectRuleStoreRequest $request)
    {
        $data = $request->validated();

        RedirectRule::create($data);

        return redirect(SeoHelper::getRoute('redirect_rules.index'));
    }

    public function edit(RedirectRule $redirect_rule)
    {
        $data = [
            'model' => $redirect_rule,
        ];
        return view('seo::redirect_rules.edit', $data);
    }

    public function update(RedirectRule $redirect_rule, RedirectRuleUpdateRequest $request)
    {
        $data = $request->validated();

        $redirect_rule->update($data);

        return redirect(SeoHelper::getRoute('redirect_rules.index'));
    }

    public function destroy(RedirectRule $redirect_rule)
    {
        $redirect_rule->delete();

        return redirect(SeoHelper::getRoute('redirect_rules.index'));
    }
}
